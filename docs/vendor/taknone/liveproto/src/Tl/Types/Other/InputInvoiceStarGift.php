<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputpeer peer long gift_id true hide_name true include_upgrade textwithentities message
 * @return InputInvoice
 */

final class InputInvoiceStarGift extends Instance {
	public function request(object $peer,int $gift_id,? true $hide_name = null,? true $include_upgrade = null,? object $message = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xe8625e92);
		$flags = 0;
		$flags |= is_null($hide_name) ? 0 : (1 << 0);
		$flags |= is_null($include_upgrade) ? 0 : (1 << 2);
		$flags |= is_null($message) ? 0 : (1 << 1);
		$writer->writeInt($flags);
		$writer->write($peer->read());
		$writer->writeLong($gift_id);
		if(is_null($message) === false):
			$writer->write($message->read());
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['hide_name'] = true;
		else:
			$result['hide_name'] = false;
		endif;
		if($flags & (1 << 2)):
			$result['include_upgrade'] = true;
		else:
			$result['include_upgrade'] = false;
		endif;
		$result['peer'] = $reader->tgreadObject();
		$result['gift_id'] = $reader->readLong();
		if($flags & (1 << 1)):
			$result['message'] = $reader->tgreadObject();
		else:
			$result['message'] = null;
		endif;
		return new self($result);
	}
}

?>