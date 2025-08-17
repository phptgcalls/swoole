<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param Vector<DcOption> dc_options
 * @return Update
 */

final class UpdateDcOptions extends Instance {
	public function request(array $dc_options) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x8e5e9873);
		$writer->tgwriteVector($dc_options,'DcOption');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['dc_options'] = $reader->tgreadVector('DcOption');
		return new self($result);
	}
}

?>