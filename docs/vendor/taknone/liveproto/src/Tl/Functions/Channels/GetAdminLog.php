<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Channels;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputchannel channel string q long max_id long min_id int limit channeladminlogeventsfilter events_filter Vector<InputUser> admins
 * @return channels.AdminLogResults
 */

final class GetAdminLog extends Instance {
	public function request(object $channel,string $q,int $max_id,int $min_id,int $limit,? object $events_filter = null,? array $admins = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x33ddf480);
		$flags = 0;
		$flags |= is_null($events_filter) ? 0 : (1 << 0);
		$flags |= is_null($admins) ? 0 : (1 << 1);
		$writer->writeInt($flags);
		$writer->write($channel->read());
		$writer->tgwriteBytes($q);
		if(is_null($events_filter) === false):
			$writer->write($events_filter->read());
		endif;
		if(is_null($admins) === false):
			$writer->tgwriteVector($admins,'InputUser');
		endif;
		$writer->writeLong($max_id);
		$writer->writeLong($min_id);
		$writer->writeInt($limit);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>