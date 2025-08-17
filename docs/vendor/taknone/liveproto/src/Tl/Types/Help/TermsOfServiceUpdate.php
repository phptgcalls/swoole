<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Help;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int expires help terms_of_service
 * @return help.TermsOfServiceUpdate
 */

final class TermsOfServiceUpdate extends Instance {
	public function request(int $expires,object $terms_of_service) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x28ecf961);
		$writer->writeInt($expires);
		$writer->write($terms_of_service->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['expires'] = $reader->readInt();
		$result['terms_of_service'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>