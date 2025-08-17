<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Payments;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputmedia invoice_media
 * @return payments.ExportedInvoice
 */

final class ExportInvoice extends Instance {
	public function request(object $invoice_media) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xf91b065);
		$writer->write($invoice_media->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>