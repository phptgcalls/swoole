<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Smsjobs;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string terms_url int monthly_sent_sms
 * @return smsjobs.EligibilityToJoin
 */

final class EligibleToJoin extends Instance {
	public function request(string $terms_url,int $monthly_sent_sms) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xdc8b44cf);
		$writer->tgwriteBytes($terms_url);
		$writer->writeInt($monthly_sent_sms);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['terms_url'] = $reader->tgreadBytes();
		$result['monthly_sent_sms'] = $reader->readInt();
		return new self($result);
	}
}

?>