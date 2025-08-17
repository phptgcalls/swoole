<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string currency long amount string crypto_currency long crypto_amount string transaction_id
 * @return MessageAction
 */

final class MessageActionGiftTon extends Instance {
	public function request(string $currency,int $amount,string $crypto_currency,int $crypto_amount,? string $transaction_id = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xa8a3c699);
		$flags = 0;
		$flags |= is_null($transaction_id) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->tgwriteBytes($currency);
		$writer->writeLong($amount);
		$writer->tgwriteBytes($crypto_currency);
		$writer->writeLong($crypto_amount);
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
		$result['crypto_currency'] = $reader->tgreadBytes();
		$result['crypto_amount'] = $reader->readLong();
		if($flags & (1 << 0)):
			$result['transaction_id'] = $reader->tgreadBytes();
		else:
			$result['transaction_id'] = null;
		endif;
		return new self($result);
	}
}

?>