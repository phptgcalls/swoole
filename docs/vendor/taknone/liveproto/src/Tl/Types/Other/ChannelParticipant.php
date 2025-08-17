<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long user_id int date int subscription_until_date
 * @return ChannelParticipant
 */

final class ChannelParticipant extends Instance {
	public function request(int $user_id,int $date,? int $subscription_until_date = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xcb397619);
		$flags = 0;
		$flags |= is_null($subscription_until_date) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->writeLong($user_id);
		$writer->writeInt($date);
		if(is_null($subscription_until_date) === false):
			$writer->writeInt($subscription_until_date);
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		$result['user_id'] = $reader->readLong();
		$result['date'] = $reader->readInt();
		if($flags & (1 << 0)):
			$result['subscription_until_date'] = $reader->readInt();
		else:
			$result['subscription_until_date'] = null;
		endif;
		return new self($result);
	}
}

?>