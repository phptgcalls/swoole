<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param Vector<long> channels int quantity int until_date true only_new_subscribers true winners_are_visible Vector<string> countries_iso2 string prize_description int months long stars
 * @return MessageMedia
 */

final class MessageMediaGiveaway extends Instance {
	public function request(array $channels,int $quantity,int $until_date,? true $only_new_subscribers = null,? true $winners_are_visible = null,? array $countries_iso2 = null,? string $prize_description = null,? int $months = null,? int $stars = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xaa073beb);
		$flags = 0;
		$flags |= is_null($only_new_subscribers) ? 0 : (1 << 0);
		$flags |= is_null($winners_are_visible) ? 0 : (1 << 2);
		$flags |= is_null($countries_iso2) ? 0 : (1 << 1);
		$flags |= is_null($prize_description) ? 0 : (1 << 3);
		$flags |= is_null($months) ? 0 : (1 << 4);
		$flags |= is_null($stars) ? 0 : (1 << 5);
		$writer->writeInt($flags);
		$writer->tgwriteVector($channels,'long');
		if(is_null($countries_iso2) === false):
			$writer->tgwriteVector($countries_iso2,'string');
		endif;
		if(is_null($prize_description) === false):
			$writer->tgwriteBytes($prize_description);
		endif;
		$writer->writeInt($quantity);
		if(is_null($months) === false):
			$writer->writeInt($months);
		endif;
		if(is_null($stars) === false):
			$writer->writeLong($stars);
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
			$result['winners_are_visible'] = true;
		else:
			$result['winners_are_visible'] = false;
		endif;
		$result['channels'] = $reader->tgreadVector('long');
		if($flags & (1 << 1)):
			$result['countries_iso2'] = $reader->tgreadVector('string');
		else:
			$result['countries_iso2'] = null;
		endif;
		if($flags & (1 << 3)):
			$result['prize_description'] = $reader->tgreadBytes();
		else:
			$result['prize_description'] = null;
		endif;
		$result['quantity'] = $reader->readInt();
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
		$result['until_date'] = $reader->readInt();
		return new self($result);
	}
}

?>