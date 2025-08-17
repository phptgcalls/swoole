<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param mediaareacoordinates coordinates inputchannel channel int msg_id
 * @return MediaArea
 */

final class InputMediaAreaChannelPost extends Instance {
	public function request(object $coordinates,object $channel,int $msg_id) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x2271f2bf);
		$writer->write($coordinates->read());
		$writer->write($channel->read());
		$writer->writeInt($msg_id);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['coordinates'] = $reader->tgreadObject();
		$result['channel'] = $reader->tgreadObject();
		$result['msg_id'] = $reader->readInt();
		return new self($result);
	}
}

?>