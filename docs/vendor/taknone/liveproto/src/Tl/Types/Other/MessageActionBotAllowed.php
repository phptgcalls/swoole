<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param true attach_menu true from_request string domain botapp app
 * @return MessageAction
 */

final class MessageActionBotAllowed extends Instance {
	public function request(? true $attach_menu = null,? true $from_request = null,? string $domain = null,? object $app = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xc516d679);
		$flags = 0;
		$flags |= is_null($attach_menu) ? 0 : (1 << 1);
		$flags |= is_null($from_request) ? 0 : (1 << 3);
		$flags |= is_null($domain) ? 0 : (1 << 0);
		$flags |= is_null($app) ? 0 : (1 << 2);
		$writer->writeInt($flags);
		if(is_null($domain) === false):
			$writer->tgwriteBytes($domain);
		endif;
		if(is_null($app) === false):
			$writer->write($app->read());
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 1)):
			$result['attach_menu'] = true;
		else:
			$result['attach_menu'] = false;
		endif;
		if($flags & (1 << 3)):
			$result['from_request'] = true;
		else:
			$result['from_request'] = false;
		endif;
		if($flags & (1 << 0)):
			$result['domain'] = $reader->tgreadBytes();
		else:
			$result['domain'] = null;
		endif;
		if($flags & (1 << 2)):
			$result['app'] = $reader->tgreadObject();
		else:
			$result['app'] = null;
		endif;
		return new self($result);
	}
}

?>