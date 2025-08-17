<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string name document document int rarity_permille
 * @return StarGiftAttribute
 */

final class StarGiftAttributePattern extends Instance {
	public function request(string $name,object $document,int $rarity_permille) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x13acff19);
		$writer->tgwriteBytes($name);
		$writer->write($document->read());
		$writer->writeInt($rarity_permille);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['name'] = $reader->tgreadBytes();
		$result['document'] = $reader->tgreadObject();
		$result['rarity_permille'] = $reader->readInt();
		return new self($result);
	}
}

?>