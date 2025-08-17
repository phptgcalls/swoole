<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param geopoint geo int zoom int w int h pagecaption caption
 * @return PageBlock
 */

final class PageBlockMap extends Instance {
	public function request(object $geo,int $zoom,int $w,int $h,object $caption) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xa44f3ef6);
		$writer->write($geo->read());
		$writer->writeInt($zoom);
		$writer->writeInt($w);
		$writer->writeInt($h);
		$writer->write($caption->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['geo'] = $reader->tgreadObject();
		$result['zoom'] = $reader->readInt();
		$result['w'] = $reader->readInt();
		$result['h'] = $reader->readInt();
		$result['caption'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>