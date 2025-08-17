<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string title string data
 * @return NotificationSound
 */

final class NotificationSoundLocal extends Instance {
	public function request(string $title,string $data) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x830b9ae4);
		$writer->tgwriteBytes($title);
		$writer->tgwriteBytes($data);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['title'] = $reader->tgreadBytes();
		$result['data'] = $reader->tgreadBytes();
		return new self($result);
	}
}

?>