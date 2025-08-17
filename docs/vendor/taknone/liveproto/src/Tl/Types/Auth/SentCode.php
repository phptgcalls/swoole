<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Auth;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param auth type string phone_code_hash auth next_type int timeout
 * @return auth.SentCode
 */

final class SentCode extends Instance {
	public function request(object $type,string $phone_code_hash,? object $next_type = null,? int $timeout = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x5e002502);
		$flags = 0;
		$flags |= is_null($next_type) ? 0 : (1 << 1);
		$flags |= is_null($timeout) ? 0 : (1 << 2);
		$writer->writeInt($flags);
		$writer->write($type->read());
		$writer->tgwriteBytes($phone_code_hash);
		if(is_null($next_type) === false):
			$writer->write($next_type->read());
		endif;
		if(is_null($timeout) === false):
			$writer->writeInt($timeout);
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		$result['type'] = $reader->tgreadObject();
		$result['phone_code_hash'] = $reader->tgreadBytes();
		if($flags & (1 << 1)):
			$result['next_type'] = $reader->tgreadObject();
		else:
			$result['next_type'] = null;
		endif;
		if($flags & (1 << 2)):
			$result['timeout'] = $reader->readInt();
		else:
			$result['timeout'] = null;
		endif;
		return new self($result);
	}
}

?>