<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param geopoint geo int heading int period int proximity_notification_radius replymarkup reply_markup
 * @return BotInlineMessage
 */

final class BotInlineMessageMediaGeo extends Instance {
	public function request(object $geo,? int $heading = null,? int $period = null,? int $proximity_notification_radius = null,? object $reply_markup = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x51846fd);
		$flags = 0;
		$flags |= is_null($heading) ? 0 : (1 << 0);
		$flags |= is_null($period) ? 0 : (1 << 1);
		$flags |= is_null($proximity_notification_radius) ? 0 : (1 << 3);
		$flags |= is_null($reply_markup) ? 0 : (1 << 2);
		$writer->writeInt($flags);
		$writer->write($geo->read());
		if(is_null($heading) === false):
			$writer->writeInt($heading);
		endif;
		if(is_null($period) === false):
			$writer->writeInt($period);
		endif;
		if(is_null($proximity_notification_radius) === false):
			$writer->writeInt($proximity_notification_radius);
		endif;
		if(is_null($reply_markup) === false):
			$writer->write($reply_markup->read());
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
		if($flags & (1 << 2)):
			$result['reply_markup'] = $reader->tgreadObject();
		else:
			$result['reply_markup'] = null;
		endif;
		return new self($result);
	}
}

?>