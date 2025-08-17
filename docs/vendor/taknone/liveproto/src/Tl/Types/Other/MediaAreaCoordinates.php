<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param double x double y double w double h double rotation double radius
 * @return MediaAreaCoordinates
 */

final class MediaAreaCoordinates extends Instance {
	public function request(float $x,float $y,float $w,float $h,float $rotation,? float $radius = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xcfc9e002);
		$flags = 0;
		$flags |= is_null($radius) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->writeDouble($x);
		$writer->writeDouble($y);
		$writer->writeDouble($w);
		$writer->writeDouble($h);
		$writer->writeDouble($rotation);
		if(is_null($radius) === false):
			$writer->writeDouble($radius);
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		$result['x'] = $reader->readDouble();
		$result['y'] = $reader->readDouble();
		$result['w'] = $reader->readDouble();
		$result['h'] = $reader->readDouble();
		$result['rotation'] = $reader->readDouble();
		if($flags & (1 << 0)):
			$result['radius'] = $reader->readDouble();
		else:
			$result['radius'] = null;
		endif;
		return new self($result);
	}
}

?>