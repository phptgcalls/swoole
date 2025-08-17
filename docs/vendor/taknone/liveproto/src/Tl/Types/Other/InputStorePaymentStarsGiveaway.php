<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long stars inputpeer boost_peer long random_id int until_date string currency long amount int users true only_new_subscribers true winners_are_visible Vector<InputPeer> additional_peers Vector<string> countries_iso2 string prize_description
 * @return InputStorePaymentPurpose
 */

final class InputStorePaymentStarsGiveaway extends Instance {
	public function request(int $stars,object $boost_peer,int $random_id,int $until_date,string $currency,int $amount,int $users,? true $only_new_subscribers = null,? true $winners_are_visible = null,? array $additional_peers = null,? array $countries_iso2 = null,? string $prize_description = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x751f08fa);
		$flags = 0;
		$flags |= is_null($only_new_subscribers) ? 0 : (1 << 0);
		$flags |= is_null($winners_are_visible) ? 0 : (1 << 3);
		$flags |= is_null($additional_peers) ? 0 : (1 << 1);
		$flags |= is_null($countries_iso2) ? 0 : (1 << 2);
		$flags |= is_null($prize_description) ? 0 : (1 << 4);
		$writer->writeInt($flags);
		$writer->writeLong($stars);
		$writer->write($boost_peer->read());
		if(is_null($additional_peers) === false):
			$writer->tgwriteVector($additional_peers,'InputPeer');
		endif;
		if(is_null($countries_iso2) === false):
			$writer->tgwriteVector($countries_iso2,'string');
		endif;
		if(is_null($prize_description) === false):
			$writer->tgwriteBytes($prize_description);
		endif;
		$writer->writeLong($random_id);
		$writer->writeInt($until_date);
		$writer->tgwriteBytes($currency);
		$writer->writeLong($amount);
		$writer->writeInt($users);
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
		if($flags & (1 << 3)):
			$result['winners_are_visible'] = true;
		else:
			$result['winners_are_visible'] = false;
		endif;
		$result['stars'] = $reader->readLong();
		$result['boost_peer'] = $reader->tgreadObject();
		if($flags & (1 << 1)):
			$result['additional_peers'] = $reader->tgreadVector('InputPeer');
		else:
			$result['additional_peers'] = null;
		endif;
		if($flags & (1 << 2)):
			$result['countries_iso2'] = $reader->tgreadVector('string');
		else:
			$result['countries_iso2'] = null;
		endif;
		if($flags & (1 << 4)):
			$result['prize_description'] = $reader->tgreadBytes();
		else:
			$result['prize_description'] = null;
		endif;
		$result['random_id'] = $reader->readLong();
		$result['until_date'] = $reader->readInt();
		$result['currency'] = $reader->tgreadBytes();
		$result['amount'] = $reader->readLong();
		$result['users'] = $reader->readInt();
		return new self($result);
	}
}

?>