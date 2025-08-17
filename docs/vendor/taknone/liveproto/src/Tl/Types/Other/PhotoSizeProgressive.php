<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string type int w int h Vector<int> sizes
 * @return PhotoSize
 */

final class PhotoSizeProgressive extends Instance {
	public function request(string $type,int $w,int $h,array $sizes) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xfa3efb95);
		$writer->tgwriteBytes($type);
		$writer->writeInt($w);
		$writer->writeInt($h);
		$writer->tgwriteVector($sizes,'int');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['type'] = $reader->tgreadBytes();
		$result['w'] = $reader->readInt();
		$result['h'] = $reader->readInt();
		$result['sizes'] = $reader->tgreadVector('int');
		return new self($result);
	}
}

?>