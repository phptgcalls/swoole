<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string currency long amount long stars string crypto_currency long crypto_amount string transaction_id
 * @return MessageAction
 */

final class MessageActionGiftStars extends Instance {
	public function request(string $currency,int $amount,int $stars,? string $crypto_currency = null,? int $crypto_amount = null,? string $transaction_id = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x45d5b021);
		$flags = 0;
		$flags |= is_null($crypto_currency) ? 0 : (1 << 0);
		$flags |= is_null($crypto_amount) ? 0 : (1 << 0);
		$flags |= is_null($transaction_id) ? 0 : (1 << 1);
		$writer->writeInt($flags);
		$writer->tgwriteBytes($currency);
		$writer->writeLong($amount);
		$writer->writeLong($stars);
		if(is_null($crypto_currency) === false):
			$writer->tgwriteBytes($crypto_currency);
		endif;
		if(is_null($crypto_amount) === false):
			$writer->writeLong($crypto_amount);
		endif;
		if(is_null($transaction_id) === false):
			$writer->tgwriteBytes($transaction_id);
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		$result['currency'] = $reader->tgreadBytes();
		$result['amount'] = $reader->readLong();
		$result['stars'] = $reader->readLong();
		if($flags & (1 << 0)):
			$result['crypto_currency'] = $reader->tgreadBytes();
		else:
			$result['crypto_currency'] = null;
		endif;
		if($flags & (1 << 0)):
			$result['crypto_amount'] = $reader->readLong();
		else:
			$result['crypto_amount'] = null;
		endif;
		if($flags & (1 << 1)):
			$result['transaction_id'] = $reader->tgreadBytes();
		else:
			$result['transaction_id'] = null;
		endif;
		return new self($result);
	}
}

?>