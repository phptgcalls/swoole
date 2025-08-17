<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string title string description string currency long total_amount string start_param true shipping_address_requested true test webdocument photo int receipt_msg_id messageextendedmedia extended_media
 * @return MessageMedia
 */

final class MessageMediaInvoice extends Instance {
	public function request(string $title,string $description,string $currency,int $total_amount,string $start_param,? true $shipping_address_requested = null,? true $test = null,? object $photo = null,? int $receipt_msg_id = null,? object $extended_media = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xf6a548d3);
		$flags = 0;
		$flags |= is_null($shipping_address_requested) ? 0 : (1 << 1);
		$flags |= is_null($test) ? 0 : (1 << 3);
		$flags |= is_null($photo) ? 0 : (1 << 0);
		$flags |= is_null($receipt_msg_id) ? 0 : (1 << 2);
		$flags |= is_null($extended_media) ? 0 : (1 << 4);
		$writer->writeInt($flags);
		$writer->tgwriteBytes($title);
		$writer->tgwriteBytes($description);
		if(is_null($photo) === false):
			$writer->write($photo->read());
		endif;
		if(is_null($receipt_msg_id) === false):
			$writer->writeInt($receipt_msg_id);
		endif;
		$writer->tgwriteBytes($currency);
		$writer->writeLong($total_amount);
		$writer->tgwriteBytes($start_param);
		if(is_null($extended_media) === false):
			$writer->write($extended_media->read());
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
		if($flags & (1 << 2)):
			$result['receipt_msg_id'] = $reader->readInt();
		else:
			$result['receipt_msg_id'] = null;
		endif;
		$result['currency'] = $reader->tgreadBytes();
		$result['total_amount'] = $reader->readLong();
		$result['start_param'] = $reader->tgreadBytes();
		if($flags & (1 << 4)):
			$result['extended_media'] = $reader->tgreadObject();
		else:
			$result['extended_media'] = null;
		endif;
		return new self($result);
	}
}

?>