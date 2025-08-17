<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param bytes random_id bytes option
 * @return channels.SponsoredMessageReportResult
 */

final class ReportSponsoredMessage extends Instance {
	public function request(string $random_id,string $option) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x12cbf0c4);
		$writer->tgwriteBytes($random_id);
		$writer->tgwriteBytes($option);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>