<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string title Vector<MessageReportOption> options
 * @return ReportResult
 */

final class ReportResultChooseOption extends Instance {
	public function request(string $title,array $options) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xf0e4e0b6);
		$writer->tgwriteBytes($title);
		$writer->tgwriteVector($options,'MessageReportOption');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['title'] = $reader->tgreadBytes();
		$result['options'] = $reader->tgreadVector('MessageReportOption');
		return new self($result);
	}
}

?>