<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param mediaareacoordinates coordinates string emoji double temperature_c int color
 * @return MediaArea
 */

final class MediaAreaWeather extends Instance {
	public function request(object $coordinates,string $emoji,float $temperature_c,int $color) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x49a6549c);
		$writer->write($coordinates->read());
		$writer->tgwriteBytes($emoji);
		$writer->writeDouble($temperature_c);
		$writer->writeInt($color);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['coordinates'] = $reader->tgreadObject();
		$result['emoji'] = $reader->tgreadBytes();
		$result['temperature_c'] = $reader->readDouble();
		$result['color'] = $reader->readInt();
		return new self($result);
	}
}

?>