<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int n double x double y double zoom
 * @return MaskCoords
 */

final class MaskCoords extends Instance {
	public function request(int $n,float $x,float $y,float $zoom) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xaed6dbb2);
		$writer->writeInt($n);
		$writer->writeDouble($x);
		$writer->writeDouble($y);
		$writer->writeDouble($zoom);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['n'] = $reader->readInt();
		$result['x'] = $reader->readDouble();
		$result['y'] = $reader->readDouble();
		$result['zoom'] = $reader->readDouble();
		return new self($result);
	}
}

?>