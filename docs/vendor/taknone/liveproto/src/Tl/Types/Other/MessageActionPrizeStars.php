<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long stars string transaction_id peer boost_peer int giveaway_msg_id true unclaimed
 * @return MessageAction
 */

final class MessageActionPrizeStars extends Instance {
	public function request(int $stars,string $transaction_id,object $boost_peer,int $giveaway_msg_id,? true $unclaimed = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xb00c47a2);
		$flags = 0;
		$flags |= is_null($unclaimed) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->writeLong($stars);
		$writer->tgwriteBytes($transaction_id);
		$writer->write($boost_peer->read());
		$writer->writeInt($giveaway_msg_id);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['unclaimed'] = true;
		else:
			$result['unclaimed'] = false;
		endif;
		$result['stars'] = $reader->readLong();
		$result['transaction_id'] = $reader->tgreadBytes();
		$result['boost_peer'] = $reader->tgreadObject();
		$result['giveaway_msg_id'] = $reader->readInt();
		return new self($result);
	}
}

?>