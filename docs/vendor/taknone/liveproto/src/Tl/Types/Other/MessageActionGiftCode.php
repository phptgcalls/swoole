<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int months string slug true via_giveaway true unclaimed peer boost_peer string currency long amount string crypto_currency long crypto_amount textwithentities message
 * @return MessageAction
 */

final class MessageActionGiftCode extends Instance {
	public function request(int $months,string $slug,? true $via_giveaway = null,? true $unclaimed = null,? object $boost_peer = null,? string $currency = null,? int $amount = null,? string $crypto_currency = null,? int $crypto_amount = null,? object $message = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x56d03994);
		$flags = 0;
		$flags |= is_null($via_giveaway) ? 0 : (1 << 0);
		$flags |= is_null($unclaimed) ? 0 : (1 << 5);
		$flags |= is_null($boost_peer) ? 0 : (1 << 1);
		$flags |= is_null($currency) ? 0 : (1 << 2);
		$flags |= is_null($amount) ? 0 : (1 << 2);
		$flags |= is_null($crypto_currency) ? 0 : (1 << 3);
		$flags |= is_null($crypto_amount) ? 0 : (1 << 3);
		$flags |= is_null($message) ? 0 : (1 << 4);
		$writer->writeInt($flags);
		if(is_null($boost_peer) === false):
			$writer->write($boost_peer->read());
		endif;
		$writer->writeInt($months);
		$writer->tgwriteBytes($slug);
		if(is_null($currency) === false):
			$writer->tgwriteBytes($currency);
		endif;
		if(is_null($amount) === false):
			$writer->writeLong($amount);
		endif;
		if(is_null($crypto_currency) === false):
			$writer->tgwriteBytes($crypto_currency);
		endif;
		if(is_null($crypto_amount) === false):
			$writer->writeLong($crypto_amount);
		endif;
		if(is_null($message) === false):
			$writer->write($message->read());
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['via_giveaway'] = true;
		else:
			$result['via_giveaway'] = false;
		endif;
		if($flags & (1 << 5)):
			$result['unclaimed'] = true;
		else:
			$result['unclaimed'] = false;
		endif;
		if($flags & (1 << 1)):
			$result['boost_peer'] = $reader->tgreadObject();
		else:
			$result['boost_peer'] = null;
		endif;
		$result['months'] = $reader->readInt();
		$result['slug'] = $reader->tgreadBytes();
		if($flags & (1 << 2)):
			$result['currency'] = $reader->tgreadBytes();
		else:
			$result['currency'] = null;
		endif;
		if($flags & (1 << 2)):
			$result['amount'] = $reader->readLong();
		else:
			$result['amount'] = null;
		endif;
		if($flags & (1 << 3)):
			$result['crypto_currency'] = $reader->tgreadBytes();
		else:
			$result['crypto_currency'] = null;
		endif;
		if($flags & (1 << 3)):
			$result['crypto_amount'] = $reader->readLong();
		else:
			$result['crypto_amount'] = null;
		endif;
		if($flags & (1 << 4)):
			$result['message'] = $reader->tgreadObject();
		else:
			$result['message'] = null;
		endif;
		return new self($result);
	}
}

?>