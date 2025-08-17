<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Phone;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputpeer peer bool revoke
 * @return phone.GroupCallStreamRtmpUrl
 */

final class GetGroupCallStreamRtmpUrl extends Instance {
	public function request(object $peer,bool $revoke) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xdeb3abbf);
		$writer->write($peer->read());
		$writer->tgwriteBool($revoke);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>