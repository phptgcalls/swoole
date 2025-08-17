<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param Vector<Document> icons
 * @return WebPageAttribute
 */

final class WebPageAttributeStarGiftCollection extends Instance {
	public function request(array $icons) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x31cad303);
		$writer->tgwriteVector($icons,'Document');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['icons'] = $reader->tgreadVector('Document');
		return new self($result);
	}
}

?>