<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Payments;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int date long bot_id string title string description invoice invoice string currency long total_amount string transaction_id Vector<User> users webdocument photo
 * @return payments.PaymentReceipt
 */

final class PaymentReceiptStars extends Instance {
	public function request(int $date,int $bot_id,string $title,string $description,object $invoice,string $currency,int $total_amount,string $transaction_id,array $users,? object $photo = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xdabbf83a);
		$flags = 0;
		$flags |= is_null($photo) ? 0 : (1 << 2);
		$writer->writeInt($flags);
		$writer->writeInt($date);
		$writer->writeLong($bot_id);
		$writer->tgwriteBytes($title);
		$writer->tgwriteBytes($description);
		if(is_null($photo) === false):
			$writer->write($photo->read());
		endif;
		$writer->write($invoice->read());
		$writer->tgwriteBytes($currency);
		$writer->writeLong($total_amount);
		$writer->tgwriteBytes($transaction_id);
		$writer->tgwriteVector($users,'User');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		$result['date'] = $reader->readInt();
		$result['bot_id'] = $reader->readLong();
		$result['title'] = $reader->tgreadBytes();
		$result['description'] = $reader->tgreadBytes();
		if($flags & (1 << 2)):
			$result['photo'] = $reader->tgreadObject();
		else:
			$result['photo'] = null;
		endif;
		$result['invoice'] = $reader->tgreadObject();
		$result['currency'] = $reader->tgreadBytes();
		$result['total_amount'] = $reader->readLong();
		$result['transaction_id'] = $reader->tgreadBytes();
		$result['users'] = $reader->tgreadVector('User');
		return new self($result);
	}
}

?>