<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Channels;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string title Vector<SponsoredMessageReportOption> options
 * @return channels.SponsoredMessageReportResult
 */

final class SponsoredMessageReportResultChooseOption extends Instance {
	public function request(string $title,array $options) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x846f9e42);
		$writer->tgwriteBytes($title);
		$writer->tgwriteVector($options,'SponsoredMessageReportOption');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['title'] = $reader->tgreadBytes();
		$result['options'] = $reader->tgreadVector('SponsoredMessageReportOption');
		return new self($result);
	}
}

?>