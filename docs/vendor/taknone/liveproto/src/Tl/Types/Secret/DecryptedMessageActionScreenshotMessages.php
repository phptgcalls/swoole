<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Secret;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param Vector<long> random_ids
 * @return secret.DecryptedMessageAction
 */

final class DecryptedMessageActionScreenshotMessages extends Instance {
	public function request(array $random_ids) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x8ac1f475);
		$writer->tgwriteVector($random_ids,'long');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['random_ids'] = $reader->tgreadVector('long');
		return new self($result);
	}
}

?>