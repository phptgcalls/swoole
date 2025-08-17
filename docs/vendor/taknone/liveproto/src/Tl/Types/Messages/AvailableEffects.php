<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int hash Vector<AvailableEffect> effects Vector<Document> documents
 * @return messages.AvailableEffects
 */

final class AvailableEffects extends Instance {
	public function request(int $hash,array $effects,array $documents) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xbddb616e);
		$writer->writeInt($hash);
		$writer->tgwriteVector($effects,'AvailableEffect');
		$writer->tgwriteVector($documents,'Document');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['hash'] = $reader->readInt();
		$result['effects'] = $reader->tgreadVector('AvailableEffect');
		$result['documents'] = $reader->tgreadVector('Document');
		return new self($result);
	}
}

?>