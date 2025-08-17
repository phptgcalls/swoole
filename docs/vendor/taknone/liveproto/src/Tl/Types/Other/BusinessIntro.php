<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string title string description document sticker
 * @return BusinessIntro
 */

final class BusinessIntro extends Instance {
	public function request(string $title,string $description,? object $sticker = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x5a0a066d);
		$flags = 0;
		$flags |= is_null($sticker) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->tgwriteBytes($title);
		$writer->tgwriteBytes($description);
		if(is_null($sticker) === false):
			$writer->write($sticker->read());
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		$result['title'] = $reader->tgreadBytes();
		$result['description'] = $reader->tgreadBytes();
		if($flags & (1 << 0)):
			$result['sticker'] = $reader->tgreadObject();
		else:
			$result['sticker'] = null;
		endif;
		return new self($result);
	}
}

?>