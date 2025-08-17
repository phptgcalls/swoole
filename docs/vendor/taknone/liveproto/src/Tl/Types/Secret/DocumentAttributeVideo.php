<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Secret;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int duration int w int h true round_message
 * @return secret.DocumentAttribute
 */

final class DocumentAttributeVideo extends Instance {
	public function request(int $duration,int $w,int $h,? true $round_message = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xef02ce6);
		$flags = 0;
		$flags |= is_null($round_message) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->writeInt($duration);
		$writer->writeInt($w);
		$writer->writeInt($h);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['round_message'] = true;
		else:
			$result['round_message'] = false;
		endif;
		$result['duration'] = $reader->readInt();
		$result['w'] = $reader->readInt();
		$result['h'] = $reader->readInt();
		return new self($result);
	}
}

?>