<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string id string title Vector<LabeledPrice> prices
 * @return ShippingOption
 */

final class ShippingOption extends Instance {
	public function request(string $id,string $title,array $prices) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xb6213cdf);
		$writer->tgwriteBytes($id);
		$writer->tgwriteBytes($title);
		$writer->tgwriteVector($prices,'LabeledPrice');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['id'] = $reader->tgreadBytes();
		$result['title'] = $reader->tgreadBytes();
		$result['prices'] = $reader->tgreadVector('LabeledPrice');
		return new self($result);
	}
}

?>