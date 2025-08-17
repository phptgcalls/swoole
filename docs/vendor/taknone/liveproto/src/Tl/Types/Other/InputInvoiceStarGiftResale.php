<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string slug inputpeer to_id true ton
 * @return InputInvoice
 */

final class InputInvoiceStarGiftResale extends Instance {
	public function request(string $slug,object $to_id,? true $ton = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xc39f5324);
		$flags = 0;
		$flags |= is_null($ton) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->tgwriteBytes($slug);
		$writer->write($to_id->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['ton'] = true;
		else:
			$result['ton'] = false;
		endif;
		$result['slug'] = $reader->tgreadBytes();
		$result['to_id'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>