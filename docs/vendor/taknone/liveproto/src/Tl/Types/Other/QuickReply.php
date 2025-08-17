<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int shortcut_id string shortcut int top_message int count
 * @return QuickReply
 */

final class QuickReply extends Instance {
	public function request(int $shortcut_id,string $shortcut,int $top_message,int $count) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x697102b);
		$writer->writeInt($shortcut_id);
		$writer->tgwriteBytes($shortcut);
		$writer->writeInt($top_message);
		$writer->writeInt($count);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['shortcut_id'] = $reader->readInt();
		$result['shortcut'] = $reader->tgreadBytes();
		$result['top_message'] = $reader->readInt();
		$result['count'] = $reader->readInt();
		return new self($result);
	}
}

?>