<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Payments;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long form_id long bot_id string title string description invoice invoice Vector<User> users webdocument photo
 * @return payments.PaymentForm
 */

final class PaymentFormStars extends Instance {
	public function request(int $form_id,int $bot_id,string $title,string $description,object $invoice,array $users,? object $photo = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x7bf6b15c);
		$flags = 0;
		$flags |= is_null($photo) ? 0 : (1 << 5);
		$writer->writeInt($flags);
		$writer->writeLong($form_id);
		$writer->writeLong($bot_id);
		$writer->tgwriteBytes($title);
		$writer->tgwriteBytes($description);
		if(is_null($photo) === false):
			$writer->write($photo->read());
		endif;
		$writer->write($invoice->read());
		$writer->tgwriteVector($users,'User');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		$result['form_id'] = $reader->readLong();
		$result['bot_id'] = $reader->readLong();
		$result['title'] = $reader->tgreadBytes();
		$result['description'] = $reader->tgreadBytes();
		if($flags & (1 << 5)):
			$result['photo'] = $reader->tgreadObject();
		else:
			$result['photo'] = null;
		endif;
		$result['invoice'] = $reader->tgreadObject();
		$result['users'] = $reader->tgreadVector('User');
		return new self($result);
	}
}

?>