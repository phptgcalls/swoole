<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputgeopoint geo_point long access_hash int w int h int zoom int scale
 * @return InputWebFileLocation
 */

final class InputWebFileGeoPointLocation extends Instance {
	public function request(object $geo_point,int $access_hash,int $w,int $h,int $zoom,int $scale) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x9f2221c9);
		$writer->write($geo_point->read());
		$writer->writeLong($access_hash);
		$writer->writeInt($w);
		$writer->writeInt($h);
		$writer->writeInt($zoom);
		$writer->writeInt($scale);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['geo_point'] = $reader->tgreadObject();
		$result['access_hash'] = $reader->readLong();
		$result['w'] = $reader->readInt();
		$result['h'] = $reader->readInt();
		$result['zoom'] = $reader->readInt();
		$result['scale'] = $reader->readInt();
		return new self($result);
	}
}

?>