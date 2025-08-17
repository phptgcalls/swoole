<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Payments;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int date long bot_id long provider_id string title string description invoice invoice string currency long total_amount string credentials_title Vector<User> users webdocument photo paymentrequestedinfo info shippingoption shipping long tip_amount
 * @return payments.PaymentReceipt
 */

final class PaymentReceipt extends Instance {
	public function request(int $date,int $bot_id,int $provider_id,string $title,string $description,object $invoice,string $currency,int $total_amount,string $credentials_title,array $users,? object $photo = null,? object $info = null,? object $shipping = null,? int $tip_amount = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x70c4fe03);
		$flags = 0;
		$flags |= is_null($photo) ? 0 : (1 << 2);
		$flags |= is_null($info) ? 0 : (1 << 0);
		$flags |= is_null($shipping) ? 0 : (1 << 1);
		$flags |= is_null($tip_amount) ? 0 : (1 << 3);
		$writer->writeInt($flags);
		$writer->writeInt($date);
		$writer->writeLong($bot_id);
		$writer->writeLong($provider_id);
		$writer->tgwriteBytes($title);
		$writer->tgwriteBytes($description);
		if(is_null($photo) === false):
			$writer->write($photo->read());
		endif;
		$writer->write($invoice->read());
		if(is_null($info) === false):
			$writer->write($info->read());
		endif;
		if(is_null($shipping) === false):
			$writer->write($shipping->read());
		endif;
		if(is_null($tip_amount) === false):
			$writer->writeLong($tip_amount);
		endif;
		$writer->tgwriteBytes($currency);
		$writer->writeLong($total_amount);
		$writer->tgwriteBytes($credentials_title);
		$writer->tgwriteVector($users,'User');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		$result['date'] = $reader->readInt();
		$result['bot_id'] = $reader->readLong();
		$result['provider_id'] = $reader->readLong();
		$result['title'] = $reader->tgreadBytes();
		$result['description'] = $reader->tgreadBytes();
		if($flags & (1 << 2)):
			$result['photo'] = $reader->tgreadObject();
		else:
			$result['photo'] = null;
		endif;
		$result['invoice'] = $reader->tgreadObject();
		if($flags & (1 << 0)):
			$result['info'] = $reader->tgreadObject();
		else:
			$result['info'] = null;
		endif;
		if($flags & (1 << 1)):
			$result['shipping'] = $reader->tgreadObject();
		else:
			$result['shipping'] = null;
		endif;
		if($flags & (1 << 3)):
			$result['tip_amount'] = $reader->readLong();
		else:
			$result['tip_amount'] = null;
		endif;
		$result['currency'] = $reader->tgreadBytes();
		$result['total_amount'] = $reader->readLong();
		$result['credentials_title'] = $reader->tgreadBytes();
		$result['users'] = $reader->tgreadVector('User');
		return new self($result);
	}
}

?>