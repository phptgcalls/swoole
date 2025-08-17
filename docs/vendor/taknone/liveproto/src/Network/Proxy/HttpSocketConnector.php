<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Network\Proxy;

use Amp\Cancellation;

use Amp\ForbidCloning;

use Amp\ForbidSerialization;

use Amp\Socket\Socket;

use Amp\Socket\ConnectContext;

use Amp\Socket\SocketAddress;

use Amp\Socket\SocketConnector;

use Amp\Socket\SocketException;

use League\Uri\Http;

use function Amp\Socket\socketConnector;

define('CRLF',chr(13).chr(10));

define('LFCR',chr(10).chr(13));

final class HttpSocketConnector implements SocketConnector {
	use ForbidCloning;
	use ForbidSerialization;

	static public function tunnel(Socket $socket,string $target,? string $username,? string $password,? Cancellation $cancellation) : void {
		if(is_null($username) or is_null($password)):
			$authHeader = strval(null);
		else:
			$authHeader = 'Proxy-Authorization: Basic '.base64_encode($username.':'.$password).CRLF;
		endif;
		$uri = Http::new($target);
		$host = $uri->getHost();
		$port = $uri->getPort();
		$ip = inet_pton($host);
		if($ip !== false and strlen($ip) === 16):
			$host = sprintf('[%s]',$ip);
		endif;
		$socket->write('CONNECT '.$host.':'.$port.' HTTP/1.1'.CRLF.'Host: '.$host.':'.$port.CRLF.'Accept: */*'.CRLF.$authHeader.'Connection: keep-Alive'.CRLF.CRLF);
		$read = function(int $length) use($socket,$cancellation) : string {
			assert($length > 0);
			$buffer = strval(null);
			do {
				$limit = $length - strlen($buffer);
				assert($limit > 0);
				$chunk = $socket->read($cancellation,$limit);
				if($chunk === null):
					throw new SocketException('The socket was closed before the tunnel could be established');
				endif;
				$buffer .= $chunk;
			} while(strlen($buffer) !== $length);
			return $buffer;
		};
		$headers = strval(null);
		do {
			$piece = $read(2);
			$headers .= $piece;
			if($piece === LFCR):
				$headers .= $read(1);
				break;
			elseif(str_ends_with($headers,CRLF.CRLF)):
				break;
			endif;
		} while(true);
		$headers = explode(CRLF,$headers);
		list($protocol,$code,$description) = explode(chr(32),array_shift($headers),3);
		list($protocol,$version) = explode(chr(47),$protocol);
		if($protocol !== 'HTTP'):
			throw new SocketException('Wrong protocol : '.$protocol);
		elseif(array_pop($headers).array_pop($headers) !== strval(null)):
			throw new SocketException('Wrong last HTTP header');
		elseif($code != 200):
			throw new SocketException($description,$code);
		endif;
		$headers = array_change_key_case(array_column(array_map(fn(string $item) : array => array_map('trim',explode(chr(58),$item)),$headers),1,0));
		if(isset($headers['content-length'])):
			$length = intval($headers['content-length']);
			if($length > 0):
				$content = $read($length);
			endif;
		endif;
	}
	public function __construct(private readonly SocketAddress | string $proxyAddress,private readonly ? string $username = null,private readonly ? string $password = null,private readonly ? SocketConnector $socketConnector = null){
	}
	public function connect(SocketAddress | string $uri,? ConnectContext $context = null,? Cancellation $cancellation = null) : Socket {
		$connector = $this->socketConnector ?? socketConnector();
		$socket = $connector->connect($this->proxyAddress,$context,$cancellation);
		self::tunnel($socket,strval($uri),$this->username,$this->password,$cancellation);
		return $socket;
	}
}

?>