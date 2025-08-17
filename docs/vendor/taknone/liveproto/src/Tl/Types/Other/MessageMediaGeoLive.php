<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param geopoint geo int period int heading int proximity_notification_radius
 * @return MessageMedia
 */

final class MessageMediaGeoLive extends Instance {
	public function request(object $geo,int $period,? int $heading = null,? int $proximity_notification_radius = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xb940c666);
		$flags = 0;
		$flags |= is_null($heading) ? 0 : (1 << 0);
		$flags |= is_null($proximity_notification_radius) ? 0 : (1 << 1);
		$writer->writeInt($flags);
		$writer->write($geo->read());
		if(is_null($heading) === false):
			$writer->writeInt($heading);
		endif;
		$writer->writeInt($period);
		if(is_null($proximity_notification_radius) === false):
			$writer->writeInt($proximity_notification_radius);
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		$result['geo'] = $reader->tgreadObject();
		if($flags & (1 << 0)):
			$result['heading'] = $reader->readInt();
		else:
			$result['heading'] = null;
		endif;
		$result['period'] = $reader->readInt();
		if($flags & (1 << 1)):
			$result['proximity_notification_radius'] = $reader->readInt();
		else:
			$result['proximity_notification_radius'] = null;
		endif;
		return new self($result);
	}
}

?>