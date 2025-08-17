<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string currency long amount int months string crypto_currency long crypto_amount textwithentities message
 * @return MessageAction
 */

final class MessageActionGiftPremium extends Instance {
	public function request(string $currency,int $amount,int $months,? string $crypto_currency = null,? int $crypto_amount = null,? object $message = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x6c6274fa);
		$flags = 0;
		$flags |= is_null($crypto_currency) ? 0 : (1 << 0);
		$flags |= is_null($crypto_amount) ? 0 : (1 << 0);
		$flags |= is_null($message) ? 0 : (1 << 1);
		$writer->writeInt($flags);
		$writer->tgwriteBytes($currency);
		$writer->writeLong($amount);
		$writer->writeInt($months);
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
		$result['currency'] = $reader->tgreadBytes();
		$result['amount'] = $reader->readLong();
		$result['months'] = $reader->readInt();
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
			$result['message'] = $reader->tgreadObject();
		else:
			$result['message'] = null;
		endif;
		return new self($result);
	}
}

?>