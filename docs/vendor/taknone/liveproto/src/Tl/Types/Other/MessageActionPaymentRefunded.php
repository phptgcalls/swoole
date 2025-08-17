<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param peer peer string currency long total_amount paymentcharge charge bytes payload
 * @return MessageAction
 */

final class MessageActionPaymentRefunded extends Instance {
	public function request(object $peer,string $currency,int $total_amount,object $charge,? string $payload = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x41b3e202);
		$flags = 0;
		$flags |= is_null($payload) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->write($peer->read());
		$writer->tgwriteBytes($currency);
		$writer->writeLong($total_amount);
		if(is_null($payload) === false):
			$writer->tgwriteBytes($payload);
		endif;
		$writer->write($charge->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		$result['peer'] = $reader->tgreadObject();
		$result['currency'] = $reader->tgreadBytes();
		$result['total_amount'] = $reader->readLong();
		if($flags & (1 << 0)):
			$result['payload'] = $reader->tgreadBytes();
		else:
			$result['payload'] = null;
		endif;
		$result['charge'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>