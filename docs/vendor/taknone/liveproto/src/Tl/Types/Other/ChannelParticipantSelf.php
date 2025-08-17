<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long user_id long inviter_id int date true via_request int subscription_until_date
 * @return ChannelParticipant
 */

final class ChannelParticipantSelf extends Instance {
	public function request(int $user_id,int $inviter_id,int $date,? true $via_request = null,? int $subscription_until_date = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x4f607bef);
		$flags = 0;
		$flags |= is_null($via_request) ? 0 : (1 << 0);
		$flags |= is_null($subscription_until_date) ? 0 : (1 << 1);
		$writer->writeInt($flags);
		$writer->writeLong($user_id);
		$writer->writeLong($inviter_id);
		$writer->writeInt($date);
		if(is_null($subscription_until_date) === false):
			$writer->writeInt($subscription_until_date);
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['via_request'] = true;
		else:
			$result['via_request'] = false;
		endif;
		$result['user_id'] = $reader->readLong();
		$result['inviter_id'] = $reader->readLong();
		$result['date'] = $reader->readInt();
		if($flags & (1 << 1)):
			$result['subscription_until_date'] = $reader->readInt();
		else:
			$result['subscription_until_date'] = null;
		endif;
		return new self($result);
	}
}

?>