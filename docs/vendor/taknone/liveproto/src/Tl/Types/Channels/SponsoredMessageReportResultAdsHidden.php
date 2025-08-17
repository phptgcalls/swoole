<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Channels;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param 
 * @return channels.SponsoredMessageReportResult
 */

final class SponsoredMessageReportResultAdsHidden extends Instance {
	public function request() : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x3e3bcf2f);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		return new self($result);
	}
}

?>