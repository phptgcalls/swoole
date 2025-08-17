<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param Vector<SavedReactionTag> tags long hash
 * @return messages.SavedReactionTags
 */

final class SavedReactionTags extends Instance {
	public function request(array $tags,int $hash) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x3259950a);
		$writer->tgwriteVector($tags,'SavedReactionTag');
		$writer->writeLong($hash);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['tags'] = $reader->tgreadVector('SavedReactionTag');
		$result['hash'] = $reader->readLong();
		return new self($result);
	}
}

?>