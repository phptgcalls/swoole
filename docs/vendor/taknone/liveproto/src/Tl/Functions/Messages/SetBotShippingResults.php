<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long query_id string error Vector<ShippingOption> shipping_options
 * @return Bool
 */

final class SetBotShippingResults extends Instance {
	public function request(int $query_id,? string $error = null,? array $shipping_options = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xe5f672fa);
		$flags = 0;
		$flags |= is_null($error) ? 0 : (1 << 0);
		$flags |= is_null($shipping_options) ? 0 : (1 << 1);
		$writer->writeInt($flags);
		$writer->writeLong($query_id);
		if(is_null($error) === false):
			$writer->tgwriteBytes($error);
		endif;
		if(is_null($shipping_options) === false):
			$writer->tgwriteVector($shipping_options,'ShippingOption');
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>