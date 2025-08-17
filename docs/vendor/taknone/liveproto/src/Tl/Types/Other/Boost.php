<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string id int date int expires true gift true giveaway true unclaimed long user_id int giveaway_msg_id string used_gift_slug int multiplier long stars
 * @return Boost
 */

final class Boost extends Instance {
	public function request(string $id,int $date,int $expires,? true $gift = null,? true $giveaway = null,? true $unclaimed = null,? int $user_id = null,? int $giveaway_msg_id = null,? string $used_gift_slug = null,? int $multiplier = null,? int $stars = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x4b3e14d6);
		$flags = 0;
		$flags |= is_null($gift) ? 0 : (1 << 1);
		$flags |= is_null($giveaway) ? 0 : (1 << 2);
		$flags |= is_null($unclaimed) ? 0 : (1 << 3);
		$flags |= is_null($user_id) ? 0 : (1 << 0);
		$flags |= is_null($giveaway_msg_id) ? 0 : (1 << 2);
		$flags |= is_null($used_gift_slug) ? 0 : (1 << 4);
		$flags |= is_null($multiplier) ? 0 : (1 << 5);
		$flags |= is_null($stars) ? 0 : (1 << 6);
		$writer->writeInt($flags);
		$writer->tgwriteBytes($id);
		if(is_null($user_id) === false):
			$writer->writeLong($user_id);
		endif;
		if(is_null($giveaway_msg_id) === false):
			$writer->writeInt($giveaway_msg_id);
		endif;
		$writer->writeInt($date);
		$writer->writeInt($expires);
		if(is_null($used_gift_slug) === false):
			$writer->tgwriteBytes($used_gift_slug);
		endif;
		if(is_null($multiplier) === false):
			$writer->writeInt($multiplier);
		endif;
		if(is_null($stars) === false):
			$writer->writeLong($stars);
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 1)):
			$result['gift'] = true;
		else:
			$result['gift'] = false;
		endif;
		if($flags & (1 << 2)):
			$result['giveaway'] = true;
		else:
			$result['giveaway'] = false;
		endif;
		if($flags & (1 << 3)):
			$result['unclaimed'] = true;
		else:
			$result['unclaimed'] = false;
		endif;
		$result['id'] = $reader->tgreadBytes();
		if($flags & (1 << 0)):
			$result['user_id'] = $reader->readLong();
		else:
			$result['user_id'] = null;
		endif;
		if($flags & (1 << 2)):
			$result['giveaway_msg_id'] = $reader->readInt();
		else:
			$result['giveaway_msg_id'] = null;
		endif;
		$result['date'] = $reader->readInt();
		$result['expires'] = $reader->readInt();
		if($flags & (1 << 4)):
			$result['used_gift_slug'] = $reader->tgreadBytes();
		else:
			$result['used_gift_slug'] = null;
		endif;
		if($flags & (1 << 5)):
			$result['multiplier'] = $reader->readInt();
		else:
			$result['multiplier'] = null;
		endif;
		if($flags & (1 << 6)):
			$result['stars'] = $reader->readLong();
		else:
			$result['stars'] = null;
		endif;
		return new self($result);
	}
}

?>