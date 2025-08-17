<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Auth;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string url int length
 * @return auth.SentCodeType
 */

final class SentCodeTypeFragmentSms extends Instance {
	public function request(string $url,int $length) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xd9565c39);
		$writer->tgwriteBytes($url);
		$writer->writeInt($length);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['url'] = $reader->tgreadBytes();
		$result['length'] = $reader->readInt();
		return new self($result);
	}
}

?>