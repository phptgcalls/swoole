<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long channel_id int launch_msg_id int winners_count int unclaimed_count Vector<long> winners int until_date true only_new_subscribers true refunded int additional_peers_count int months long stars string prize_description
 * @return MessageMedia
 */

final class MessageMediaGiveawayResults extends Instance {
	public function request(int $channel_id,int $launch_msg_id,int $winners_count,int $unclaimed_count,array $winners,int $until_date,? true $only_new_subscribers = null,? true $refunded = null,? int $additional_peers_count = null,? int $months = null,? int $stars = null,? string $prize_description = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xceaa3ea1);
		$flags = 0;
		$flags |= is_null($only_new_subscribers) ? 0 : (1 << 0);
		$flags |= is_null($refunded) ? 0 : (1 << 2);
		$flags |= is_null($additional_peers_count) ? 0 : (1 << 3);
		$flags |= is_null($months) ? 0 : (1 << 4);
		$flags |= is_null($stars) ? 0 : (1 << 5);
		$flags |= is_null($prize_description) ? 0 : (1 << 1);
		$writer->writeInt($flags);
		$writer->writeLong($channel_id);
		if(is_null($additional_peers_count) === false):
			$writer->writeInt($additional_peers_count);
		endif;
		$writer->writeInt($launch_msg_id);
		$writer->writeInt($winners_count);
		$writer->writeInt($unclaimed_count);
		$writer->tgwriteVector($winners,'long');
		if(is_null($months) === false):
			$writer->writeInt($months);
		endif;
		if(is_null($stars) === false):
			$writer->writeLong($stars);
		endif;
		if(is_null($prize_description) === false):
			$writer->tgwriteBytes($prize_description);
		endif;
		$writer->writeInt($until_date);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['only_new_subscribers'] = true;
		else:
			$result['only_new_subscribers'] = false;
		endif;
		if($flags & (1 << 2)):
			$result['refunded'] = true;
		else:
			$result['refunded'] = false;
		endif;
		$result['channel_id'] = $reader->readLong();
		if($flags & (1 << 3)):
			$result['additional_peers_count'] = $reader->readInt();
		else:
			$result['additional_peers_count'] = null;
		endif;
		$result['launch_msg_id'] = $reader->readInt();
		$result['winners_count'] = $reader->readInt();
		$result['unclaimed_count'] = $reader->readInt();
		$result['winners'] = $reader->tgreadVector('long');
		if($flags & (1 << 4)):
			$result['months'] = $reader->readInt();
		else:
			$result['months'] = null;
		endif;
		if($flags & (1 << 5)):
			$result['stars'] = $reader->readLong();
		else:
			$result['stars'] = null;
		endif;
		if($flags & (1 << 1)):
			$result['prize_description'] = $reader->tgreadBytes();
		else:
			$result['prize_description'] = null;
		endif;
		$result['until_date'] = $reader->readInt();
		return new self($result);
	}
}

?>