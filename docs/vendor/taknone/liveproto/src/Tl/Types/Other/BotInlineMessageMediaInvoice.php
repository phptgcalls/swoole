<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string title string description string currency long total_amount true shipping_address_requested true test webdocument photo replymarkup reply_markup
 * @return BotInlineMessage
 */

final class BotInlineMessageMediaInvoice extends Instance {
	public function request(string $title,string $description,string $currency,int $total_amount,? true $shipping_address_requested = null,? true $test = null,? object $photo = null,? object $reply_markup = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x354a9b09);
		$flags = 0;
		$flags |= is_null($shipping_address_requested) ? 0 : (1 << 1);
		$flags |= is_null($test) ? 0 : (1 << 3);
		$flags |= is_null($photo) ? 0 : (1 << 0);
		$flags |= is_null($reply_markup) ? 0 : (1 << 2);
		$writer->writeInt($flags);
		$writer->tgwriteBytes($title);
		$writer->tgwriteBytes($description);
		if(is_null($photo) === false):
			$writer->write($photo->read());
		endif;
		$writer->tgwriteBytes($currency);
		$writer->writeLong($total_amount);
		if(is_null($reply_markup) === false):
			$writer->write($reply_markup->read());
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 1)):
			$result['shipping_address_requested'] = true;
		else:
			$result['shipping_address_requested'] = false;
		endif;
		if($flags & (1 << 3)):
			$result['test'] = true;
		else:
			$result['test'] = false;
		endif;
		$result['title'] = $reader->tgreadBytes();
		$result['description'] = $reader->tgreadBytes();
		if($flags & (1 << 0)):
			$result['photo'] = $reader->tgreadObject();
		else:
			$result['photo'] = null;
		endif;
		$result['currency'] = $reader->tgreadBytes();
		$result['total_amount'] = $reader->readLong();
		if($flags & (1 << 2)):
			$result['reply_markup'] = $reader->tgreadObject();
		else:
			$result['reply_markup'] = null;
		endif;
		return new self($result);
	}
}

?>