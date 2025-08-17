<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string slug
 * @return PhoneCallDiscardReason
 */

final class PhoneCallDiscardReasonMigrateConferenceCall extends Instance {
	public function request(string $slug) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x9fbbf1f7);
		$writer->tgwriteBytes($slug);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['slug'] = $reader->tgreadBytes();
		return new self($result);
	}
}

?>