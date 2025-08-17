<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param photo prev_photo photo new_photo
 * @return ChannelAdminLogEventAction
 */

final class ChannelAdminLogEventActionChangePhoto extends Instance {
	public function request(object $prev_photo,object $new_photo) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x434bd2af);
		$writer->write($prev_photo->read());
		$writer->write($new_photo->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['prev_photo'] = $reader->tgreadObject();
		$result['new_photo'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>