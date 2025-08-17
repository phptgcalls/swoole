<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param message message int pts int pts_count
 * @return Update
 */

final class UpdateNewMessage extends Instance {
	public function request(object $message,int $pts,int $pts_count) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x1f2b0afd);
		$writer->write($message->read());
		$writer->writeInt($pts);
		$writer->writeInt($pts_count);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['message'] = $reader->tgreadObject();
		$result['pts'] = $reader->readInt();
		$result['pts_count'] = $reader->readInt();
		return new self($result);
	}
}

?>