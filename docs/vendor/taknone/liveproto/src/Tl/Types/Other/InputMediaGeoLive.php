<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputgeopoint geo_point true stopped int heading int period int proximity_notification_radius
 * @return InputMedia
 */

final class InputMediaGeoLive extends Instance {
	public function request(object $geo_point,? true $stopped = null,? int $heading = null,? int $period = null,? int $proximity_notification_radius = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x971fa843);
		$flags = 0;
		$flags |= is_null($stopped) ? 0 : (1 << 0);
		$flags |= is_null($heading) ? 0 : (1 << 2);
		$flags |= is_null($period) ? 0 : (1 << 1);
		$flags |= is_null($proximity_notification_radius) ? 0 : (1 << 3);
		$writer->writeInt($flags);
		$writer->write($geo_point->read());
		if(is_null($heading) === false):
			$writer->writeInt($heading);
		endif;
		if(is_null($period) === false):
			$writer->writeInt($period);
		endif;
		if(is_null($proximity_notification_radius) === false):
			$writer->writeInt($proximity_notification_radius);
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['stopped'] = true;
		else:
			$result['stopped'] = false;
		endif;
		$result['geo_point'] = $reader->tgreadObject();
		if($flags & (1 << 2)):
			$result['heading'] = $reader->readInt();
		else:
			$result['heading'] = null;
		endif;
		if($flags & (1 << 1)):
			$result['period'] = $reader->readInt();
		else:
			$result['period'] = null;
		endif;
		if($flags & (1 << 3)):
			$result['proximity_notification_radius'] = $reader->readInt();
		else:
			$result['proximity_notification_radius'] = null;
		endif;
		return new self($result);
	}
}

?>