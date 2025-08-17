<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param mediaareacoordinates coordinates long channel_id int msg_id
 * @return MediaArea
 */

final class MediaAreaChannelPost extends Instance {
	public function request(object $coordinates,int $channel_id,int $msg_id) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x770416af);
		$writer->write($coordinates->read());
		$writer->writeLong($channel_id);
		$writer->writeInt($msg_id);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['coordinates'] = $reader->tgreadObject();
		$result['channel_id'] = $reader->readLong();
		$result['msg_id'] = $reader->readInt();
		return new self($result);
	}
}

?>